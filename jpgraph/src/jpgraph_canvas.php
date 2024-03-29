<?php
/*=======================================================================
// File: 	JPGRAPH_CANVAS.PHP
// Description:	Canvas drawing extension for JpGraph
// Created: 	2001-01-08
// Author:	Johan Persson (johanp@aditus.nu)
// Ver:		$Id: jpgraph_canvas.php,v 1.11 2002/10/05 21:08:37 aditus Exp $
//
// License:	This code is released under QPL
// Copyright (C) 2001,2002 Johan Persson
//========================================================================
*/

//===================================================
// CLASS CanvasGraph
// Description: Creates a simple canvas graph which
// might be used together with the basic Image drawing
// primitives. Useful to auickoly produce some arbitrary
// graphic which benefits from all the functionality in the
// graph liek caching for example. 
//===================================================
class CanvasGraph extends Graph {
//---------------
// CONSTRUCTOR
    function CanvasGraph($aWidth=300,$aHeight=200,$aCachedName="",$timeout=0,$inline=1) {
	$this->Graph($aWidth,$aHeight,$aCachedName,$timeout,$inline);
    }

//---------------
// PUBLIC METHODS	

    function InitFrame() {
	$this->StrokePlotArea();
    }

    // Method description
    function Stroke($aStrokeFileName="") {
	if( $this->texts != null ) {
	    for($i=0; $i<count($this->texts); ++$i) {
		$this->texts[$i]->Stroke($this->img);
	    }
	}				
	$this->StrokeTitles();
	// Stream the generated picture					
	$this->cache->PutAndStream($this->img,$this->cache_name,$this->inline,$aStrokeFileName);	
    }
} // Class
/* EOF */
?>
<?php 
/**
 * Component to display the Made in Canada switch
 */

 if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

?>
<div class="jbati-made-in-ca-switch-wrapper jbati-switch-wrapper">
  <div class="jbati-made-in-ca-switch jbati-switch">
    <div class="jbati-switch-track"></div>
    <div class="jbati-switch-control">
      <input type="checkbox" id="jbati-made-in-ca-switch" class="jbati-made-in-ca-switch-input jbati-switch-input" value="false">
      <div class="jbati-switch-thumb"></div>
    </div>
  </div>
  <label for="jbati-made-in-ca-switch" class="jbati-made-in-ca-switch-label"><span class="jbati-flag-icon">🇨🇦</span>Solutions Canadiennes</label>
</div>
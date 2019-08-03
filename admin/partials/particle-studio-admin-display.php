<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://wpsocket.com
 * @since      1.0.0
 *
 * @package    Particle_Studio
 * @subpackage Particle_Studio/admin/partials
 */ 

function particlestudio_admin_page() { ?>
			<div class="wrap">
                <h1>Particle Studio</h1>
                <div id="ps-tabs-wrapper" class="nav-tab-wrapper">
                    <a id="ps-tab-general" class="nav-tab nav-tab-active" href="#tab-general">General</a>
                    <a id="ps-tab-style" class="nav-tab" href="#tab-style">Style</a>
                    <a id="ps-tab-advanced" class="nav-tab" href="#tab-advanced">Advanced</a>
                </div>
                <form id="ps-form" method="post" action="#">
                    <div id="tab-general" class="ps-tabcontent ps-tabs-active">
                        <div>Tab General is here</div>
                        <div>
                            <span>input one</span>
                            <input type="text">
                        </div>
                        <div>
                            <span>input one</span>
                            <input type="text">
                        </div>
                        <div>
                            <span>input one</span>
                            <input type="text">
                        </div>
                        <div>
                            <span>input one</span>
                            <input type="text">
                        </div>
                    </div>
                    <div id="tab-style" class="ps-tabcontent">
                        <div>Tab Style is here</div>
                    </div>
                    <div id="tab-advanced" class="ps-tabcontent">
                        <div>Tab-advanced is here</div>
                    </div>
                    <p class="submit">
                        <input type="submit" name="submit" id="submit" class="button button-primary" value="Save Changes">
                    </p>
                </form>
            </div>
        <?php 
		}

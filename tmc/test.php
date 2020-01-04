<?php
/**
 * Template Name: Page Test
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package st
 */

get_header();
?>





<div id="content-wrapper">
	<div id="example-wrapper">
		<div class="scrollContent">
			<section class="demo" id="section-slides">
				<style type="text/css">
					#pinContainer {
						width: 100%;
						height: 100%;
						overflow: hidden;
						-webkit-perspective: 1000;
								perspective: 1000;
					}
					#slideContainer {
						width: 400%; /* to contain 4 panels, each with 100% of window width */
						height: 100%;
					}
					.panel {
						height: 100%;
						width: 25%; /* relative to parent -> 25% of 400% = 100% of window width */
						float: left;
					}
				</style>
				<div id="pinContainer">
					<div id="slideContainer">
						<section class="panel blue">
							<b>ONE</b>
						</section>
						<section class="panel turqoise">
							<b>TWO</b>
						</section>
						<section class="panel green">
							<b>THREE</b>
						</section>
						<section class="panel bordeaux">
							<b>FOUR</b>
						</section>
					</div>
				</div>
			</section>
		</div>
	</div>
</div>





<?php
get_footer();

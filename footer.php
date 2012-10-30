<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 */
?>
   
      </div><!-- #main -->
    </div><! -- #wrapper -->
      <?php
	      /* A sidebar in the footer? Yep. You can can customize
	       * your footer with three columns of widgets.
	       */
	      if ( ! is_404() ) {
		      // get_sidebar( 'footer' );
        }
      ?>
      <div id="footer">
        <div class="footertxt">
          Kultuuriteaduste ja kunstide doktorikool, aadress: Rävala pst 16, Tallinn 10143. Üldkoordinaator Aleksandra Dolgopolova, <a href="mailto:ktkdk@ema.edu.ee">ktkdk@ema.edu.ee</a>
        </div>
      </div> <!-- #footer -->

<?php wp_footer(); ?>

  </body>
</html>

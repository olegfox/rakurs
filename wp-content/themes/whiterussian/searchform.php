	<? /*
  <form role="search" method="get" id="header_search_form" action="<?php echo home_url( '/' ) ?>" class="b-h__search-form js-validate" method="post">
    <input class="b-h__search-input" type="text" value="<?php echo get_search_query() ?>" name="s" id="s" placeholder="Поиск" required>
    <input type="hidden" name="post_type" value="any">
    <input class="b-h__search-button" type="submit" value="Искать">
  </form>
   */?>
  <!-- t: searchform  -->
  <div id="header_search_form" class="b-h__search-form">
    <? echo get_post_meta(9, 'search_form', true);?>    
  </div>
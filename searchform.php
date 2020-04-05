<?php
/*
* Template for rendering the search form
*/
?>
<div class="search_fields">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <form action="/" method="get" id="wp_custom_search_form">
                    <div class="search-field-container">
                        <input type="text" name="s" id="search" placeholder="Search" value="<?php the_search_query(); ?>">
                        <button class="search_icon" id="search_submit" type="submit"><i class="fa fa-search"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<form role="search" method="get" id="searchform" class="searchform input-group" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<input
		name="s"
		id="s"
		type="text"
		placeholder="<?php
			echo esc_attr_x( 'Search &hellip;', 'placeholder', 'ark' );
		?>"
		value="<?php echo get_search_query(); ?>"
		class="form-control"
	/>
	<span class="input-group-btn">
		<button type="submit" class="btn" id="searchsubmit">
			<i class="ff-font-awesome4 icon-search"></i>
		</button>
	</span>
</form>

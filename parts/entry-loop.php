<tr>
	<td>
	<?php
		while (have_rows('authors')) : the_row();
			the_sub_field('name');
		endwhile;
	?>
	</td>
	<td><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></td>
	<td><?php the_field('year'); ?></td>
</tr>

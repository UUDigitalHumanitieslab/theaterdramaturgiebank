<tr>
	<td>
		<ul>
			<?php
				while (have_rows('authors')) : the_row();
					echo '<li>';
					echo '<a href="' . get_permalink() . '">';
					the_sub_field('author');
					echo '</a>';
					echo '</li>';
				endwhile;
			?>
		</ul>
	</td>
	<td><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></td>
	<td><a href="<?php the_permalink(); ?>"><?php the_field('year'); ?></a></td>
</tr>

<tr>
	<td>
		<ul>
			<?php
				while (have_rows('authors')) : the_row();
					echo '<li>';
					the_sub_field('author');
					echo '</li>';
				endwhile;
			?>
		</ul>
	</td>
	<td><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></td>
	<td><?php the_field('year'); ?></td>
</tr>

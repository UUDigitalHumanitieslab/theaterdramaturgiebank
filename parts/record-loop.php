<?php
/**
 * Shows a single 'record' post as part of a table.
 */
?>

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
	<td><a href="<?php the_permalink(); ?>"><?php echo markdown_title(); ?></a></td>
	<td><a href="<?php the_permalink(); ?>"><?php the_field('year'); echo year_uncertain(); ?></a></td>
</tr>

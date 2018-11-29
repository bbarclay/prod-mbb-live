<?php if ( have_rows( 'downloads' ) ) : ?>
    <section class="video__downloads">
        <div class="grid  grid--buttons">
            <?php while ( have_rows( 'downloads' ) ) : the_row(); ?>
                <div class="grid__column">
                    <?php
                    $url = get_sub_field( 'file_host' ) === 'external' ? get_sub_field( 'download_file_url' ) : get_sub_field( 'download_file' );
                    echo sprintf( '<a href="%s" class="button" target="_blank">%s</a>', $url, get_sub_field( 'label' ) );
                    ?>
                </div>
            <?php endwhile; ?>
        </div>
    </section>
<?php endif; ?>
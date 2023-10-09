<ul class="social">
    <?php
    $sns = [
        'sns_facebook' => [
            'img' => 'icon-fb.svg',
            'title' => 'Facebook'
        ],
        'sns_twitter' => [
            'img' => 'icon-tw.svg',
            'title' => 'Twitte'
        ],
        'sns_line' => [
            'img' => 'icon-line.svg',
            'title' => 'Line'
        ]
    ];
    foreach ($sns as $sns_key => $sns_label) :
        $seminar_sns_data = get_field($sns_key);
        if ($seminar_sns_data) : ?>
            <li>
                <a href="<?php echo $seminar_sns_data; ?>" class="hover">
                    <img src="<?php themeUrl(); ?>/assets/images/seminar/<?php echo $sns_label['img']; ?>" alt="<?php echo $sns_label['title']; ?>">
                </a>
            </li>
        <?php endif;
    endforeach; ?>
</ul>
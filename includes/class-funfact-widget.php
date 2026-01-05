<?php
if (! defined('ABSPATH')) exit;

class Funfact_Widget extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'funfact_counters';
    }

    public function get_title()
    {
        return __('Funfact Counters', 'funfact');
    }

    public function get_icon()
    {
        return 'eicon-counter';
    }

    public function get_categories()
    {
        return ['basic'];
    }

    public function get_script_depends()
    {
        return ['funfact-counter'];
    }

    public function get_style_depends()
    {
        return ['funfact-style'];
    }

    protected function register_controls()
    {

        $this->start_controls_section(
            'content_section',
            ['label' => __('Funfact Items', 'funfact')]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control('number', [
            'label' => __('Number', 'funfact'),
            'type' => \Elementor\Controls_Manager::NUMBER,
            'default' => 28,
        ]);

        $repeater->add_control('suffix', [
            'label' => __('Suffix', 'funfact'),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => 'k',
        ]);

        $repeater->add_control('label', [
            'label' => __('Label', 'funfact'),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => 'Marketing professionals have used Temtech',
        ]);

        $repeater->add_control('delay', [
            'label' => __('Animation Delay (s)', 'funfact'),
            'type' => \Elementor\Controls_Manager::NUMBER,
            'default' => 0.3,
        ]);

        $this->add_control('stats', [
            'label' => __('Counters', 'funfact'),
            'type' => \Elementor\Controls_Manager::REPEATER,
            'fields' => $repeater->get_controls(),
            'default' => [
                ['number' => 28, 'suffix' => 'k'],
                ['number' => 7, 'suffix' => 'k+'],
                ['number' => 20, 'suffix' => 'k'],
                ['number' => 5, 'suffix' => 'k'],
            ],
        ]);

        $this->add_control(
            'enable_box',
            [
                'label' => __('Enable Box', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'yes',
                'return_value' => 'yes',
            ]
        );

        $this->add_control(
            'box_bg_color',
            [
                'label' => __('Box Background', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#F3F6FF',
                'condition' => [
                    'enable_box' => 'yes',
                ],
                'selectors' => [
                    '{{WRAPPER}} .funfact-box' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'number_color',
            [
                'label' => __('Number Color', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#22E28A',
                'selectors' => [
                    '{{WRAPPER}} .funfact-number, {{WRAPPER}} .funfact-suffix' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'text_color',
            [
                'label' => __('Text Color', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#0B1C3F',
                'selectors' => [
                    '{{WRAPPER}} .funfact-text' => 'color: {{VALUE}};',
                ],
            ]
        );




        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        if (empty($settings['stats'])) return;
        $settings['number'] = isset($settings['number']) ? (int) $settings['number'] : 0;
?>
<div class="funfact-wrapper">
    <?php foreach ($settings['stats'] as $item): ?>
    <div class="funfact-item <?php if (isset($settings['enable_box'])) {
                                                echo $settings['enable_box'] == 'yes' ? 'has-box' : '';
                                            } ?>">

        <?php
                    if (isset($settings['enable_box']) && $settings['enable_box'] == 'yes') : ?>
        <div class="funfact-box">
            <?php endif; ?>

            <div class="funfact-number-wrap">
                <span class="funfact-number" data-end="<?php echo esc_attr($item['number']); ?>">
                    0
                </span>

                <?php if (! empty($item['suffix'])) : ?>
                <span class="funfact-suffix">
                    <?php echo esc_html($item['suffix']); ?>
                </span>
                <?php endif; ?>
            </div>


            <p class="funfact-text">
                <?php if (! empty($item['label'])) : ?>
                <?php echo esc_html($item['label']); ?>
                <?php endif; ?>
            </p>

            <?php if (isset($settings['enable_box']) && $settings['enable_box'] == 'yes') : ?>
        </div>
        <?php endif; ?>

    </div>
    <?php endforeach; ?>
</div>
<?php
    }
}
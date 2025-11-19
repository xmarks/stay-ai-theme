<?php

namespace App\View\Components;

use App\Helpers\ACF;
use Roots\Acorn\View\Component;

class CTA extends Component
{
    /**
     * Create the component instance.
     *
     * @param string|null $subtitle
     * @param string|null $title
     * @param array|null  $button
     */
    public function __construct(
        public ?string $subtitle = null,
        public ?string $title = null,
        public ?array  $button = null
    )
    {
        $this->check_and_fill_properties();
    }

    /**
     * @return void
     */
    protected function check_and_fill_properties(): void
    {
        $this->subtitle = $this->subtitle ?: null;
        $this->title = $this->title ?: null;
        
        if (
            ! is_null( $this->subtitle ) ||
            ! is_null( $this->title ) ||
            ! is_null( $this->button )
            ) {
            return;
        }

        $settings = $this->get_settings();

        $this->subtitle = $settings['subtitle'];
        $this->title = $settings['title'];
        $this->button = $settings['button'] ?: null;
    }

    /**
     * @return array
     */
    protected function get_settings(): array
    {
        $fields = ACF::get_field( 'global_cta', 'option' );

        return [
            'subtitle' => $fields['subtitle'] ?? null,
            'title' => $fields['title'] ?? null,
            'button' => $fields['button'] ?? null,
        ];
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return $this->view( 'components.cta' );
    }
}

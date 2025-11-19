<?php

namespace App\View\Components;

use App\Helpers\ACF;
use Roots\Acorn\View\Component;

class MiniCta extends Component
{
    /**
     * Create the component instance.
     *
     * @param string|null $title
     * @param array|null  $button
     */
    public function __construct(
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
        if (
            ! is_null( $this->title ) ||
            ! is_null( $this->button )
            ) {
            return;
        }

        $settings = $this->get_settings();

        $this->title = $settings['title'];
        $this->button = $settings['button'] ?: null;
    }

    /**
     * @return array
     */
    protected function get_settings(): array
    {
        $fields = ACF::get_field( 'global_mini_cta', 'option' );

        return [
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
        return $this->view( 'components.mini-cta' );
    }
}

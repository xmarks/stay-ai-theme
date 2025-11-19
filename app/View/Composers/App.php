<?php

namespace App\View\Composers;

use App\Helpers\ACF;
use Carbon\Carbon;
use Roots\Acorn\View\Composer;

class App extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        '*',
    ];

    /**
     * Data to be passed to view before rendering.
     *
     * @return array
     */
    public function with()
    {
        return $this->get_data();
    }

    /**
     * @return array
     */
    protected function get_data(): array
    {
        $fields = ACF::get_fields( 'option' );
        
        return [
            'siteName' => get_bloginfo( 'name', 'display' ),
            'home_url' => home_url('/'),
            'notification_bar' => $this->validate_notification_bar( $fields['notification_bar'] ?? [] ),
            'header_logo' => $fields['header_logo'] ?? null,
            'footer_logo' => $fields['footer_logo'] ?? null,
            'socials' => $fields['social_links'] ?? null,
            'subscription_form' => $fields['footer_form'] ?? null,
            'cta_button' => $fields['cta_button'] ?? null,
            'copyright' => '© ' . date('Y') . ' Stay AI',
        ];
    }

    /**
     * @param array $data
     * @return array|null
     */
    private function validate_notification_bar( array $data ): ?array
    {
        if ( empty( $data ) || ! $data['enabled'] ) {
            return null;
        }

        $placement = is_front_page() ? 'home' : 'other';
        if ( ! in_array( $placement, $data['placements'], true ) ) {
            return null;
        }

        $current_date_time = Carbon::instance( current_datetime() );

        if ( ! empty( $data['show_from'] ) && $current_date_time->lt( Carbon::parse( $data['show_from'] ) ) ) {
            return null;
        }

        if ( ! empty( $data['show_until'] ) && $current_date_time->gt( Carbon::parse( $data['show_until'] ) ) ) {
            return null;
        }

        return $data;
    }
}

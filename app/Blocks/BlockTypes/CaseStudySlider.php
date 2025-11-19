<?php

namespace App\Blocks\BlockTypes;

use App\DTO\CaseStudyDTO;

class CaseStudySlider extends BaseBlock
{
    /**
     * @inheritDoc
     */
    protected function fill_data(): void
    {
        parent::fill_data();
        $this->prepare_cards_data();
    }

    /**
     * @return void
     */
    private function prepare_cards_data(): void
    {
        if ( empty( $this->data['cards'] ) ) {
            return;
        }

        $this->data['cards'] = array_map(
            function ( $card ) {
                $card_data = match ( $card['type'] ) {
                    'default' => ( new CaseStudyDTO( $card['case_study'] ) )->toArray(),
                    'custom' => $this->prepare_custom_card_data( $card ),
                };

                $card_data['type'] = $card['type'];

                return $card_data;
            },
            $this->data['cards']
        );
    }

    
    /**
     * @param array $card
     * @return array
     */
    private function prepare_custom_card_data( $card ): array
    {
        if ( empty( $card ) ) {
            return [];
        }

        return [
            'icon' => $card['icon'] ?? '',
            'title' => $card['title'] ?? '',
            'text' => $card['text'] ?? '',
            'button' => $card['button'] ?? ''
        ];
    }
}

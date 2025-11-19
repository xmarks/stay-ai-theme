<?php

namespace App\Blocks\BlockTypes;

class Spacer extends BaseBlock
{
    /**
     * @var array|string[]
     */
    protected array $types = ['desktop', 'mobile'];

    /**
     * @inheritDoc
     */
    protected function fill_data(): void
    {
        parent::fill_data();

        $this->data['style'] = '';

        foreach ( $this->types as $type ) {
            if ( ! empty( $this->data[$type] ) ) {
                $this->data['style'] .= $this->get_height( (int) $this->data[$type], $type );
                unset( $this->data[$type] );
            }
        }
    }

    /**
     * @param int $height
     * @param string $type
     * @return string
     */
    private function get_height( int $height, string $type ): string
    {
        if ( ! in_array( $type, $this->types ) ) {
            return '';
        }

        return $height >= 0
            ? "--{$type}Height: {$height}px;"
            : "--{$type}Margin: {$height}px 0 0;";
    }
}

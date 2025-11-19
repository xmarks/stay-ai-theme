<?php

namespace App\View\Components;

use Roots\Acorn\View\Component;

class Icon extends Component
{
    /**
     * @var string
     */
    public string $iconContent;

    /**
     * @var array<string, string|int|null>
     */
    public array $svgAttributes = [];

    /**
     * @var string[]
     */
    protected const REQUIRED_ATTRIBUTES = [
        'width',
        'height',
    ];

    /**
     * @param string $name
     * @param int|null $width
     * @param int|null $height
     * @param string|null $viewBox
     * @param string|null $class
     */
    public function __construct(
        public readonly string $name,
        public readonly ?int $width = null,
        public readonly ?int $height = null,
        public readonly ?string $viewBox = null,
        public readonly ?string $class = null,
    ) {
        $iconPath = "images/icons/{$name}.svg";

        $this->iconContent = $this->prepareContent(
            file_get_contents( asset( $iconPath )->path() )
        ) ?? '';

        if ( isset( $this->class ) ) {
            $this->svgAttributes['class'] = $this->class;
        }
    }

    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function render(): \Illuminate\Contracts\View\View
    {
        return $this->view( 'components.icon' );
    }

    /**
     * @param string|null $iconXml
     * @return string|null
     */
    protected function prepareContent( ?string $iconXml ): ?string
    {
        if ( ! $iconXml ) {
            return null;
        }

        $parsedIcon = simplexml_load_string( $iconXml );
        $iconAttributes = $parsedIcon->attributes();

        unset( $parsedIcon );

        foreach ( $iconAttributes as $attribute => $value ) {
            if ( property_exists( $this, $attribute ) && isset( $this->{$attribute} ) ) {
                $value = $this->{$attribute};
            }

            $this->svgAttributes[$attribute] = (string) $value;
        }

        foreach ( self::REQUIRED_ATTRIBUTES as $attribute ) {
            if ( property_exists( $this, $attribute ) && isset( $this->{$attribute} ) ) {
                $this->svgAttributes[$attribute] = $this->{$attribute};
            }
        }

        return strip_tags( $iconXml, [
            'animate', 'circle', 'clipPath', 'defs', 'ellipse', 'image', 'line', 'linearGradient',
            'mask', 'path', 'polygon', 'polyline', 'radialGradient', 'rect', 'style', 'symbol', 'text',
            'textPath', 'use', 'view',
        ] );
    }
}

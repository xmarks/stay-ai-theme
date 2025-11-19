<?php

namespace App\Helpers;

use App\Contracts\HtmlRendererInterface;
use App\View\Components\Icon;
use Illuminate\Support\Facades\Blade;

class Html implements HtmlRendererInterface
{
    /**
     * @inheritDoc
     */
    public function link( array $attrs, mixed $render_callback = null ): string
    {
        $attrs['href'] = $attrs['href'] ?? $attrs['url'] ?? null;
        if ( ! isset( $attrs['href'] ) ) {
            return '';
        }

        $text = $attrs['text']
            ?? $attrs['title']
            ?? '';

        if ( ! empty( $attrs['icon'] ) ) {
            $icon_component = is_array( $attrs['icon'] )
                ? new Icon( ...$attrs['icon'] )
                : new Icon( $attrs['icon'] );

            $text .= Blade::renderComponent( $icon_component );
            unset( $attrs['icon'] );
        }

        $attrs['href'] ??= $attrs['url'] ?? null;
        $attrs['type'] ??= 'default';


        switch ( $attrs['type'] ) {
            case 'tel':
                preg_match_all( '/\d+/', $attrs['href'], $matches );
                if ( ! empty( $matches ) ) {
                    $attrs['href'] = 'tel:' . join( '', $matches[0] );
                }
                break;
            case 'email':
                $attrs['href'] = 'mailto:' . $attrs['href'];
                break;
            case 'skype':
                $attrs['href'] = 'skype:' . $attrs['href'];
                break;
            case 'whatsapp':
                preg_match_all( '/\d+/', $attrs['href'], $matches );
                if ( ! empty( $matches ) ) {
                    $attrs['href'] = 'https://wa.me/' . join( '', $matches[0] );
                }
                break;
        }

        $unset_keys = [
            'text',
            'title',
            'type',
            'url',
        ];

        foreach ( $unset_keys as $key ) {
            if ( isset( $attrs[$key] ) ) {
                unset( $attrs[$key] );
            }
        }

        foreach ( $attrs as $key => $value ) {
            if ( $value ) {
                $attribute_pairs[] = "$key=\"" . esc_attr( $value ) . '"';
            }
        }

        $html = '<a ' . join( ' ', $attribute_pairs ) . '><span>%s</span></a>';

        if ( $render_callback ) {
            return sprintf( $html, $render_callback( $text ) );
        }

        return sprintf( $html, $text );
    }

    /**
     * @inheritDoc
     */
    public function get_image( array $params = [], bool $add_srcset = true ): string
    {
        if ( empty( $params['attachment_id'] ) && empty( $params['src'] ) ) {
            return '';
        }

        if ( isset( $params['attachment_id'] ) ) {
            $size = $params['size'] ?? 'full';

            [$src, $width, $height] = wp_get_attachment_image_src( $params['attachment_id'], $size );
            $image_alt = get_post_meta( $params['attachment_id'], '_wp_attachment_image_alt', true );
            $params['src'] = $src;

            if ( $width && $height ) {
                $params['data-aspect-ratio'] = round( $width / $height, 4 );
            }

            $params['alt'] = $image_alt ?: get_the_title( $params['attachment_id'] );

            if ( $add_srcset ) {
                $params['srcset'] = wp_get_attachment_image_srcset( $params['attachment_id'], $size );
            }

            unset( $params['size'] );
            unset( $params['attachment_id'] );
        }

        if ( empty( $params['alt'] ) ) {
            $params['alt'] = explode('.', basename( strval( $params['src'] ) ) )[0];
        }

        if ( empty( $params['loading'] ) ) {
            $params['loading'] = 'lazy';
        }

        $attrs = join( ' ', array_map( function ( $key ) use ( $params ) {

            if ( is_bool( $params[$key] ) && $params[$key] ) {
                return $key;
            }

            return $key . '="' . $params[$key] . '"';

        }, array_keys( $params ) ) );

        return sprintf( "<img %s />", $attrs );
    }

    /**
     * @inheritDoc
     */
    public function get_video( array $params = [] ): string
    {
        if ( empty( $params['attachment_id'] ) && empty( $params['src'] ) ) {
            return '';
        }

        if ( isset( $params['attachment_id'] ) ) {
            $meta = wp_get_attachment_metadata( $params['attachment_id'] );
            $url = wp_get_attachment_url( $params['attachment_id'] );
            unset( $params['attachment_id'] );
        } else {
            $url = $params['src'];
            unset( $params['src'] );
        }

        if ( ! empty( $params['poster'] ) ) {
            $params['poster'] = is_int( $params['poster'] )
                ? wp_get_attachment_url( $params['poster'] )
                : $params['poster'];
        } else {
            unset( $params['poster'] );
        }

        $attrs = join( ' ', array_map( function ( $key ) use ( $params ) {
            if ( is_bool( $params[$key] ) && $params[$key] ) {
                return $key;
            }

            return $key . '="' . $params[$key] . '"';
        }, array_keys( $params ) ) );

        $mime_type = $meta['mime_type'] ?? 'video/mp4';

        return sprintf(
            "<video %s ><source src=\"%s\" type=\"%s\">%s</video>",
            $attrs,
            $url,
            $mime_type,
            __( 'Your browser does not support the video tag.', 'sage' ),
        );
    }

    /**
     * @inheritDoc
     */
    public function input( $type, $name, array $attrs = [], array $options = [] ): string
    {
        $attributes = '';
        foreach ( $attrs as $attr_name => $attr_value ) {
            $attributes .= sprintf( ' %s="%s"', $attr_name, esc_attr( $attr_value ) );
        }

        switch ( $type ) {
            case 'textarea':
                return sprintf( '<textarea name="%s"%s>%s</textarea>', esc_attr( $name ), $attributes, esc_textarea( $attrs['value'] ) );

            case 'select':
                $html = sprintf( '<select name="%s"%s>', esc_attr( $name ), $attributes );
                foreach ( $options as $option_value => $option_label ) {
                    $html .= sprintf( '<option value="%s"%s>%s</option>', esc_attr( $option_value ), selected( $attrs['value'], $option_value, false ), esc_html( $option_label ) );
                }
                $html .= '</select>';
                return $html;

            case 'radio':
                $html = '';
                foreach ( $options as $option_value => $option_label ) {
                    $html .= sprintf( '<label><input type="%s" name="%s" value="%s"%s%s> %s</label>', esc_attr( $type ), esc_attr( $name ), esc_attr( $option_value ), checked( $attrs['value'], $option_value, false ), $attributes, esc_html( $option_label ) );
                }
                return $html;

            default:
                return sprintf( '<input type="%s" name="%s" value="%s"%s>', esc_attr( $type ), esc_attr( $name ), esc_attr( $attrs['value'] ), $attributes );
        }
    }
}

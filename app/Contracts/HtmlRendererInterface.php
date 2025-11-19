<?php

namespace App\Contracts;

interface HtmlRendererInterface
{
    /**
     * @param array $attrs
     * @param mixed $render_callback
     * @return string
     */
    public function link( array $attrs, mixed $render_callback = null ): string;

    /**
     * @param array $params
     * @param bool  $add_srcset
     * @return string
     */
    public function get_image( array $params = [], bool $add_srcset = true ): string;

    /**
     * @param array $params
     * @return string
     */
    public function get_video( array $params = [] ): string;

    /**
     * @param       $type
     * @param       $name
     * @param array $attrs
     * @param array $options
     * @return string
     */
    public function input( $type, $name, array $attrs = [], array $options = [] ): string;
}

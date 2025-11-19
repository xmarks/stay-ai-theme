import { registerFormatType } from '@wordpress/rich-text';
import { RichTextToolbarButton } from '@wordpress/block-editor';
import { __ } from '@wordpress/i18n';

registerFormatType('custom/gradient-highlight', {
  title: __('Italic Wrapper', 'textdomain'),
  tagName: 'i',
  className: null,
  edit({ isActive, value, onChange }) {
    return (
      <RichTextToolbarButton
        icon="editor-italic"
        title={__('Gradient Highlight', 'textdomain')}
        isActive={isActive}
        onClick={() => {
          onChange(
            wp.richText.toggleFormat(value, {
              type: 'custom/gradient-highlight',
            }),
          );
        }}
      />
    );
  },
});

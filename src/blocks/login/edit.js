import { __ } from '@wordpress/i18n';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl } from '@wordpress/components';
import ServerSideRender from '@wordpress/server-side-render';
import './editor.scss';

export default function Edit( { attributes, setAttributes } ) {
	const { redirectTo } = attributes;

	return (
		<>
			<InspectorControls>
				<PanelBody title={ __( 'Settings', 'gianism' ) }>
					<TextControl
						label={ __( 'Redirect URL', 'gianism' ) }
						help={ __( 'URL to redirect after login. Leave empty for current page.', 'gianism' ) }
						value={ redirectTo }
						onChange={ ( value ) => setAttributes( { redirectTo: value } ) }
					/>
				</PanelBody>
			</InspectorControls>
			<div { ...useBlockProps() }>
				<ServerSideRender
					block="gianism/login"
					attributes={ attributes }
				/>
			</div>
		</>
	);
}

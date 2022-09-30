import { useState } from '@wordpress/element';
import { RichText, InspectorControls, BlockControls } from '@wordpress/block-editor';
import { Panel, PanelBody, TextControl } from '@wordpress/components';

const Edit = (props) => {
    const {className, attributes, setAttributes} = props;
    const {title, nameLabel, emailLabel, passwordLabel, submitText, text} = attributes;
    const [hasText, setHasText] = useState(text);

    return (
        <>
            <InspectorControls>
                <Panel>
                    <PanelBody title='Labels' initialOpen={true}>
                        <TextControl
                            label="Name Label"
                            value={nameLabel}
                            onChange={(newLabel) => setAttributes({nameLabel: newLabel})}
                        />
                        <TextControl
                            label="Email Label"
                            value={emailLabel}
                            onChange={(newLabel) => setAttributes({emailLabel: newLabel})}
                        />
                        <TextControl
                            label="Password Label"
                            value={passwordLabel}
                            onChange={(newLabel) => setAttributes({passwordLabel: newLabel})}
                        />
                        <TextControl
                            label="Submit Text"
                            value={submitText}
                            onChange={(newLabel) => setAttributes({submitText: newLabel})}
                        />
                    </PanelBody>
                </Panel>
            </InspectorControls>
            <BlockControls
                controls={[
                    {
                        icon: "text",
                        title: "Add text",
                        isActive: text || hasText,
                        onClick: () => setHasText(!hasText)
                    }
                ]}
            />
            <div className={className}>
                <div className="signin__container">
                    <RichText
                        tagName='h1'
                        placeholder='Título del formulario'
                        className='sigin__titulo'
                        value={title}
                        onChange={(newTitle) => setAttributes({title: newTitle})}
                    />
                    {(text || hasText) &&
                        <RichText
                            tagName='p'
                            placeholder='Descripción del formulario'
                            value={text}
                            onChange={(newText) => setAttributes({text: newText})}
                        />
                    }
                    <form className="signin__form" id="signup">
                        <div className="signin__name name--campo">
                            <label for="Name">{nameLabel}</label>
                            <input name="name" type="text" id="name" />
                        </div>
                        <div className="signin__email name--campo">
                            <label for="email">{emailLabel}</label>
                            <input name="email" type="email" id="email" />
                        </div>
                        <div className="signin__pass name--campo">
                            <label for="password">{passwordLabel}</label>
                            <input name="password" type="password" id="password" />
                        </div>
                        <div className="signin__submit">
                            <input type="submit" value={submitText} />
                        </div>
                    </form>
                    <div className="message"></div>
                </div>
            </div>
        </>
    );
}


export default Edit;
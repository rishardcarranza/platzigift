import { registerBlockType } from "@wordpress/blocks";
import Edit from "./edit";
import Save from "./save";
import "./styles.scss";

registerBlockType("fl/register", {
    title: 'Register',
    category: 'widgets',
    icon: 'admin-users',
    attributes: {
        title: {
            source: 'html',
            selector: 'h1',
            default: 'Register'
        },
        nameLabel: {
            type: 'string',
            default: 'Name'
        },
        emailLabel: {
            type: 'string',
            default: 'Email'
        },
        passwordLabel: {
            type: 'string',
            default: 'Password'
        },
        submitText: {
            type: 'string',
            default: 'Create'
        },
        text: {
            source: 'html',
            selector: 'p'
        }
    },
    styles: [
        {
            name: 'light',
            label: 'Light Mode',
            isDefault: true
        },
        {
            name: 'dark',
            label: 'Dark Mode',
            isDefault: true
        }
    ],
    edit: Edit,
    save: Save,
});
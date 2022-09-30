import { registerBlockType } from '@wordpress/blocks';
import meta from "./../block.json";
import Edit from "./edit";
import "./edit.scss";

registerBlockType(meta, {
    edit: Edit,
    save: () => null,
});

!function(){"use strict";var e=window.wp.blocks,t=window.wp.element,a=window.wp.blockEditor,l=window.wp.components;(0,e.registerBlockType)("fl/register",{title:"Register",category:"widgets",icon:"admin-users",attributes:{title:{source:"html",selector:"h1",default:"Register"},nameLabel:{type:"string",default:"Name"},emailLabel:{type:"string",default:"Email"},passwordLabel:{type:"string",default:"Password"},submitText:{type:"string",default:"Create"},text:{source:"html",selector:"p"}},styles:[{name:"light",label:"Light Mode",isDefault:!0},{name:"dark",label:"Dark Mode",isDefault:!0}],edit:e=>{const{className:n,attributes:m,setAttributes:s}=e,{title:i,nameLabel:r,emailLabel:c,passwordLabel:o,submitText:d,text:p}=m,[u,E]=(0,t.useState)(p);return(0,t.createElement)(t.Fragment,null,(0,t.createElement)(a.InspectorControls,null,(0,t.createElement)(l.Panel,null,(0,t.createElement)(l.PanelBody,{title:"Labels",initialOpen:!0},(0,t.createElement)(l.TextControl,{label:"Name Label",value:r,onChange:e=>s({nameLabel:e})}),(0,t.createElement)(l.TextControl,{label:"Email Label",value:c,onChange:e=>s({emailLabel:e})}),(0,t.createElement)(l.TextControl,{label:"Password Label",value:o,onChange:e=>s({passwordLabel:e})}),(0,t.createElement)(l.TextControl,{label:"Submit Text",value:d,onChange:e=>s({submitText:e})})))),(0,t.createElement)(a.BlockControls,{controls:[{icon:"text",title:"Add text",isActive:p||u,onClick:()=>E(!u)}]}),(0,t.createElement)("div",{className:n},(0,t.createElement)("div",{className:"signin__container"},(0,t.createElement)(a.RichText,{tagName:"h1",placeholder:"Título del formulario",className:"sigin__titulo",value:i,onChange:e=>s({title:e})}),(p||u)&&(0,t.createElement)(a.RichText,{tagName:"p",placeholder:"Descripción del formulario",value:p,onChange:e=>s({text:e})}),(0,t.createElement)("form",{className:"signin__form",id:"signup"},(0,t.createElement)("div",{className:"signin__name name--campo"},(0,t.createElement)("label",{for:"Name"},r),(0,t.createElement)("input",{name:"name",type:"text",id:"name"})),(0,t.createElement)("div",{className:"signin__email name--campo"},(0,t.createElement)("label",{for:"email"},c),(0,t.createElement)("input",{name:"email",type:"email",id:"email"})),(0,t.createElement)("div",{className:"signin__pass name--campo"},(0,t.createElement)("label",{for:"password"},o),(0,t.createElement)("input",{name:"password",type:"password",id:"password"})),(0,t.createElement)("div",{className:"signin__submit"},(0,t.createElement)("input",{type:"submit",value:d}))),(0,t.createElement)("div",{className:"message"}))))},save:e=>{const{className:l,attributes:n}=e,{title:m,nameLabel:s,emailLabel:i,passwordLabel:r,submitText:c,text:o}=n;return(0,t.createElement)("div",{className:l},(0,t.createElement)("div",{className:"signin__container"},(0,t.createElement)(a.RichText.Content,{tagName:"h1",className:"sigin__titulo",value:m}),o&&(0,t.createElement)(a.RichText.Content,{tagName:"p",value:o}),(0,t.createElement)("form",{className:"signin__form",id:"signup"},(0,t.createElement)("div",{className:"signin__name name--campo"},(0,t.createElement)("label",{for:"Name"},s),(0,t.createElement)("input",{name:"name",type:"text",id:"name"})),(0,t.createElement)("div",{className:"signin__email name--campo"},(0,t.createElement)("label",{for:"email"},i),(0,t.createElement)("input",{name:"email",type:"email",id:"email"})),(0,t.createElement)("div",{className:"signin__pass name--campo"},(0,t.createElement)("label",{for:"password"},r),(0,t.createElement)("input",{name:"password",type:"password",id:"password"})),(0,t.createElement)("div",{className:"signin__submit"},(0,t.createElement)("input",{type:"submit",value:c}))),(0,t.createElement)("div",{className:"message"})))}})}();
(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-2d22b9e2"],{f079:function(t,s,e){"use strict";e.r(s);var i=function(){var t=this,s=t.$createElement,e=t._self._c||s;return e("div",[e("div",{staticClass:"settings-popup-row-params"},[e("div",{staticClass:"settings-popup-item-wrapper"},[t._v("\n\t\t\tRequired\n\t\t")]),e("div",{staticClass:"settings-popup-item-wrapper"},[e("div",{staticClass:"settings-popup-radio-wrapper"},[e("div",{staticClass:"settings-popup-radio-btn",class:{active:t.settings.required},on:{click:function(s){return t.setSettings(!0)}}},[t._v("Yes")]),e("div",{staticClass:"settings-popup-radio-btn",class:{active:!t.settings.required},on:{click:function(s){return t.setSettings(!1)}}},[t._v("No")])])])]),e("div",{staticClass:"settings-popup-row-params"},[e("div",{staticClass:"settings-popup-item-wrapper"},[t._v("\n\t\t\tFile path\n\t\t")]),e("div",{staticClass:"settings-popup-item-wrapper"},[e("div",{staticClass:"setting-popup-item-table-search"},[e("input",{directives:[{name:"model",rawName:"v-model",value:t.settings.path,expression:"settings.path"}],attrs:{type:"text",placeholder:"path for uplaod"},domProps:{value:t.settings.path},on:{keyup:function(s){return t.setSettings(t.settings.required)},input:function(s){s.target.composing||t.$set(t.settings,"path",s.target.value)}}})])])])])},n=[],p={props:["isRequired","fieldSettings"],data:function(){return{settings:{}}},methods:{setSettings:function(t){this.settings.required=t,this.$emit("changeSettings",this.settings)}},mounted:function(){"undefined"==typeof this.settings.path&&this.$set(this.settings,"path","undefined"==typeof this.fieldSettings.path?"public/images/upload":this.fieldSettings.path),"undefined"==typeof this.settings.required&&this.$set(this.settings,"required",this.isRequired),this.setSettings(this.settings.required)}},a=p,r=e("2877"),u=Object(r["a"])(a,i,n,!1,null,null,null);s["default"]=u.exports}}]);
//# sourceMappingURL=chunk-2d22b9e2.7b21aad7.js.map
(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-77ea84ab"],{"5aeb":function(e,t,a){},"61f0":function(e,t,a){"use strict";a.r(t);var s=function(){var e=this,t=e.$createElement,a=e._self._c||t;return a("div",{staticClass:"detail"},[a("div",{staticClass:"detail-head"},[a("div",{staticClass:"detail-head-name"},[a("div",{staticClass:"detail-icon-wrapper"},[a("svg",{attrs:{width:"14",height:"13"}},[a("use",{attrs:{"xlink:href":"#tableicon"}})])]),"tableAddElement"!=e.$route.name?[a("div",{staticClass:"detail-name-wrapper"},[a("div",{staticClass:"detail-head-label"},[e._v("Edit element")]),a("div",{staticClass:"detail-head-descr"},[e._v(e._s(e.tableCode))])]),a("div",{staticClass:"detail-head__buttons"},[a("button",{staticClass:"el-gbtn",on:{click:e.cancel}},[e._v("Cancel")]),a("button",{staticClass:"el-gbtn",on:{click:e.remove}},[e._v("Remove")]),a("button",{staticClass:"el-btn",on:{click:e.saveElement}},[e._v("Save")])])]:[a("div",{staticClass:"detail-name-wrapper"},[a("div",{staticClass:"detail-head-label"},[e._v("New Element")]),a("div",{staticClass:"detail-head-descr"},[e._v(e._s(e.tableCode))])]),a("div",{staticClass:"detail-head__buttons"},[a("button",{staticClass:"el-gbtn",on:{click:e.cancel}},[e._v("Cancel")]),a("button",{staticClass:"el-btn",on:{click:e.createElement}},[e._v("Create")])])]],2)]),e._l(e.selectedElement,function(t,s){return a("div",{staticClass:"detail-feild"},[a("div",{staticClass:"detail-field-name"},[a("span",[e._v(e._s(s))]),a("small",[e._v(e._s(s))])]),a("div",{staticClass:"detail-field-box"},[a("MainField",{attrs:{mode:"edit",params:{fieldName:t.fieldName,value:t.value,settings:e.$store.getters.getColumnSettings(e.tableCode,e.columns[s],e.selectedElement)}},on:{onChange:e.changeFieldValue}})],1)])})],2)},i=[],n=(a("ac6a"),a("96cf"),a("3b8d")),l=(a("7f7f"),a("6e3e")),r=a("4328"),o=a.n(r),c={components:{MainField:l["default"]},data:function(){return{columns:{},tableCode:!1,selectedElement:{}}},mounted:function(){var e=this,t={select:{},where:[],order:[]};t.select.from=this.$route.params.tableCode;var a=this.$store.getters.getPrimaryKeyCode(this.$route.params.tableCode);if(this.columns=this.$store.getters.getColumns(this.$route.params.tableCode),this.tableCode=this.$route.params.tableCode,"tableAddElement"!=this.$route.name)t.select.where={operation:"and",fields:[{code:a,operation:"IS",value:this.$route.params.id}]},this.$store.dispatch("selectElement",t).then(function(){e.selectedElement=e.$store.state.tables.selectedElement});else for(var s in this.columns)this.selectedElement[s]={value:"",fieldName:this.columns[s].em.type_info.fieldComponent}},methods:{changeFieldValue:function(e){this.selectedElement[e.settings.fieldCode].value=e.value},saveElement:function(){var e=this;this.$store.dispatch("saveSelectedElement",{selectedElement:this.selectedElement,tableCode:this.tableCode}).then(function(){e.ElMessage("👌 Element saved!")})},createElement:function(){var e=Object(n["a"])(regeneratorRuntime.mark(function e(){var t,a,s,i,n,l;return regeneratorRuntime.wrap(function(e){while(1)switch(e.prev=e.next){case 0:t=this.$store.getters.getPrimaryKeyCode(this.tableCode),a=[],s=[],e.t0=regeneratorRuntime.keys(this.selectedElement);case 4:if((e.t1=e.t0()).done){e.next=12;break}if(i=e.t1.value,t!=i){e.next=8;break}return e.abrupt("continue",4);case 8:a.push(i),s.push(this.selectedElement[i].value),e.next=4;break;case 12:return n=o.a.stringify({insert:{table:this.tableCode,columns:a,values:s}}),e.next=15,this.$axios.post("/api/el/insert/",n);case 15:l=e.sent,1==l.data.success?(this.$router.push({name:"tableDetail",params:{tableCode:this.tableCode,id:l.data.lastid}}),this.ElMessage("Element created!")):this.ElMessage.error("Cant create element!");case 17:case"end":return e.stop()}},e,this)}));function t(){return e.apply(this,arguments)}return t}(),cancel:function(){this.$router.go(-1)},remove:function(){var e=Object(n["a"])(regeneratorRuntime.mark(function e(){var t,a=this;return regeneratorRuntime.wrap(function(e){while(1)switch(e.prev=e.next){case 0:return t=this.$store.getters.getPrimaryKeyCode(this.tableCode),e.next=3,this.$store.dispatch("removeRecord",{delete:{table:this.tableCode,where:{operation:"and",fields:[{code:t,operation:"IS",value:this.selectedElement[t].value}]}}}).then(function(){a.cancel(),a.ElMessage("Element removed!")});case 3:case"end":return e.stop()}},e,this)}));function t(){return e.apply(this,arguments)}return t}()}},d=c,u=(a("85d3"),a("2877")),m=Object(u["a"])(d,s,i,!1,null,null,null);t["default"]=m.exports},"85d3":function(e,t,a){"use strict";var s=a("5aeb"),i=a.n(s);i.a},ac6a:function(e,t,a){for(var s=a("cadf"),i=a("0d58"),n=a("2aba"),l=a("7726"),r=a("32e9"),o=a("84f2"),c=a("2b4c"),d=c("iterator"),u=c("toStringTag"),m=o.Array,h={CSSRuleList:!0,CSSStyleDeclaration:!1,CSSValueList:!1,ClientRectList:!1,DOMRectList:!1,DOMStringList:!1,DOMTokenList:!0,DataTransferItemList:!1,FileList:!1,HTMLAllCollection:!1,HTMLCollection:!1,HTMLFormElement:!1,HTMLSelectElement:!1,MediaList:!0,MimeTypeArray:!1,NamedNodeMap:!1,NodeList:!0,PaintRequestList:!1,Plugin:!1,PluginArray:!1,SVGLengthList:!1,SVGNumberList:!1,SVGPathSegList:!1,SVGPointList:!1,SVGStringList:!1,SVGTransformList:!1,SourceBufferList:!1,StyleSheetList:!0,TextTrackCueList:!1,TextTrackList:!1,TouchList:!1},v=i(h),f=0;f<v.length;f++){var C,b=v[f],p=h[b],g=l[b],E=g&&g.prototype;if(E&&(E[d]||r(E,d,m),E[u]||r(E,u,b),o[b]=m,p))for(C in s)E[C]||n(E,C,s[C],!0)}}}]);
//# sourceMappingURL=chunk-77ea84ab.403eda89.js.map
(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-15cbbf78"],{3698:function(e,t,s){"use strict";var a=s("898e"),n=s.n(a);n.a},"898e":function(e,t,s){},efa1:function(e,t,s){"use strict";s.r(t);var a=function(){var e=this,t=e.$createElement,s=e._self._c||t;return s("div",{staticClass:"update-wrapper"},[e._m(0),s("div",{staticClass:"update-content"},[s("div",{staticClass:"update-version"},[e._v("\n\t\t\tCurrent version: "),s("em",[e._v(e._s(e.currentVersion))]),e.showLatestIsInstalled&&!e.showLoader?s("div",[e._v(" You have the latest version")]):e._e()]),e.successUpdate?[s("div",{staticClass:"update-success"},[e._v("System has been updated successfully")])]:e._e(),e.showLoader?s("Loader",{staticClass:"update__loader"}):e._e(),e.successUpdate?e._e():s("div",{staticClass:"update-buttons"},[s("button",{staticClass:"el-gbtn",on:{click:function(t){return e.checkVersion()}}},[e._v("Check version")]),e.canUpdate?s("button",{staticClass:"el-btn",on:{click:function(t){return e.update()}}},[e._v("Update to "+e._s(e.newVersion))]):e._e()])],2)])},n=[function(){var e=this,t=e.$createElement,s=e._self._c||t;return s("div",{staticClass:"update-head"},[s("div",{staticClass:"update-head-name"},[s("div",{staticClass:"update-icon-wrapper"},[e._v(" ⚙️ ")]),s("div",{staticClass:"update-name-wrapper"},[s("div",{staticClass:"update-head-label"},[e._v("Update")]),s("div",{staticClass:"update-head-descr"},[e._v("Check and update element")])])])])}],r=(s("96cf"),s("3b8d")),i=s("d716"),c={components:{Loader:i["a"]},data:function(){return{currentVersion:"",canUpdate:!1,newVersion:"",showLatestIsInstalled:!1,successUpdate:!1,showLoader:!1}},methods:{checkVersion:function(){var e=Object(r["a"])(regeneratorRuntime.mark(function e(){var t;return regeneratorRuntime.wrap(function(e){while(1)switch(e.prev=e.next){case 0:return this.showLoader=!0,e.next=3,this.$axios.get("/settings/checkVersion/");case 3:if(t=e.sent,this.showLoader=!1,"undefined"!=typeof t.data.success){e.next=7;break}return e.abrupt("return",this.ElMessage.error("Something goes wrong!"));case 7:1==t.data.result?(this.canUpdate=!0,this.newVersion=t.data.new_version):this.showLatestIsInstalled=!0;case 8:case"end":return e.stop()}},e,this)}));function t(){return e.apply(this,arguments)}return t}(),update:function(){var e=Object(r["a"])(regeneratorRuntime.mark(function e(){var t;return regeneratorRuntime.wrap(function(e){while(1)switch(e.prev=e.next){case 0:return this.showLoader=!0,e.next=3,this.$axios.get("/settings/update/");case 3:t=e.sent,this.showLoader=!1,"undefined"!=typeof t.data.success&&t.data.success&&(this.successUpdate=!0);case 6:case"end":return e.stop()}},e,this)}));function t(){return e.apply(this,arguments)}return t}()},mounted:function(){var e=Object(r["a"])(regeneratorRuntime.mark(function e(){var t;return regeneratorRuntime.wrap(function(e){while(1)switch(e.prev=e.next){case 0:return e.next=2,this.$axios.get("/settings/getCurrentVersion/");case 2:t=e.sent,"undefined"!=typeof t.data.success&&t.data.success&&(this.currentVersion=t.data.version);case 4:case"end":return e.stop()}},e,this)}));function t(){return e.apply(this,arguments)}return t}()},u=c,o=(s("3698"),s("2877")),d=Object(o["a"])(u,a,n,!1,null,null,null);t["default"]=d.exports}}]);
//# sourceMappingURL=chunk-15cbbf78.e91262ad.js.map
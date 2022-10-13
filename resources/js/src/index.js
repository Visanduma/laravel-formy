/* eslint-disable */

import Form from "./themes/bootstrap5/FormyForm"
import { VueEditor } from 'vue2-quill-editor'


window.axios = require('axios').default

const Formy = {
  install(Vue, options) {

    Vue.component("Form", Form);

  },
};

// Automatic installation if Vue has been added to the global scope.
if (typeof window !== "undefined" && window.Vue) {
  window.Vue.use(Formy);
}

export default Formy;

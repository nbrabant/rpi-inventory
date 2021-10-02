import HtmlSidebarComponent from '../components/html/Sidebar.vue';
import HtmlNavbarComponent from '../components/html/Navbar.vue';
import HtmlPagefooterComponent from '../components/html/PageFooter.vue';
import HtmlCardheaderComponent from '../components/html/CardHeader.vue';
import HtmlCardfooterComponent from '../components/html/CardFooter.vue';
import HtmlPaginationComponent from '../components/html/Pagination.vue';
import HtmlSliderComponent from '../components/html/Slider.vue';
import FormButtonComponent from '../components/form/Button.vue';
import FormCheckboxComponent from '../components/form/Checkbox.vue';
import FormDatepickerComponent from '../components/form/Datepicker.vue';
import FormSelectComponent from '../components/form/Select.vue';
import FormTextComponent from '../components/form/Text.vue';
import FormAutocompleteComponent from '../components/form/Autocomplete.vue';
import FormTextareaComponent from '../components/form/Textarea.vue';
import FormHiddenComponent from '../components/form/Hidden.vue';
import FormFileComponent from '../components/form/File.vue';
import FormImageComponent from '../components/form/Image.vue';
import TemplateIndexComponent from '../components/template/Index.vue';


// Html components
Vue.component('html-sidebar', HtmlSidebarComponent)
Vue.component('html-navbar', HtmlNavbarComponent)
Vue.component('html-pagefooter', HtmlPagefooterComponent)
Vue.component('html-cardheader', HtmlCardheaderComponent)
Vue.component('html-cardfooter', HtmlCardfooterComponent)
Vue.component('html-pagination', HtmlPaginationComponent)
Vue.component('html-slider', HtmlSliderComponent)

// Form components
Vue.component('form-button', FormButtonComponent)
Vue.component('form-checkbox', FormCheckboxComponent)
Vue.component('form-datepicker', FormDatepickerComponent)
// Vue.component('form-percentage',        require('../components/form/Percentage.vue'))
// Vue.component('form-price',             require('../components/form/Price.vue'))
Vue.component('form-select', FormSelectComponent)
Vue.component('form-text', FormTextComponent)
Vue.component('form-autocomplete', FormAutocompleteComponent)
Vue.component('form-textarea', FormTextareaComponent)
Vue.component('form-hidden', FormHiddenComponent)
// Vue.component('form-wysiwyg',           require('../components/form/Wysiwyg.vue'))
Vue.component('form-file', FormFileComponent)
Vue.component('form-image', FormImageComponent)

// Template components
Vue.component('template-index', TemplateIndexComponent)

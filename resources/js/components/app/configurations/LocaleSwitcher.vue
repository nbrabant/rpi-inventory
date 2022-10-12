<template>

  <div class="form-group">

    <label>{{ $t('configuration.language') }}</label>

    <select
        type="select"
        class="form-control"
        v-model="currentLocale"
        @change="switchLocale($event)"
    >

      <option v-for="locale in locales" v-bind:value="locale.code">
        {{ locale.name }}
      </option>
    </select>
  </div>

</template>

<script>

const supportedLocales = [
  {
    code: 'en',
    name: 'english'
  },
  {
    code: 'fr',
    name: 'français'
  },
]

export default {
  name: 'LocaleSwitcher',

  data() {
    return {
      currentLocale: localStorage.getItem('locale'),
      locales: supportedLocales
    };
  },

  methods: {
    switchLocale(event) {
      const locale = event.target.value
      if (locale && this.$i18n.locale !== locale) {
        localStorage.setItem('locale', locale)
        this.$i18n.locale = locale;
      }
    }
  },
}
</script>

<style scoped>

</style>

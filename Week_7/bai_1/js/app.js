// Gắn tất cả chức năng vào ứng dụng
Vue.createApp({
  mixins: [
    SearchFeature, FilterFeature, SortFeature, DisplayFeature,
    AddProductFeature, DeleteProductFeature, StatsFeature,
    KeywordWatchFeature, LifecycleFeature
  ],
  data() {
    return { products: [...window.SAMPLE_PRODUCTS] };
  }
}).mount('#app');

// Chức năng 3: lọc theo danh mục
window.FilterFeature = {
  data() { return { category: '' }; },
  computed: {
    categories() { return [...new Set(this.products.map(p => p.category))]; }
  },
  methods: {
    matchesCategory(p) { return !this.category || p.category === this.category; }
  }
};

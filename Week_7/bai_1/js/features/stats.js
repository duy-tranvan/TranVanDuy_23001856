// Chức năng 8: thống kê theo danh sách đang hiển thị
window.StatsFeature = {
  computed: {
    visibleCount() { return this.displayedProducts.length; },
    totalCount() { return this.products.length; },
    visibleStockValue() {
      return this.displayedProducts.reduce((sum, p) => sum + p.price * p.stock, 0);
    }
  },
  methods: {
    formatMoney(n) { return new Intl.NumberFormat('vi-VN').format(n) + ' đ'; }
  }
};

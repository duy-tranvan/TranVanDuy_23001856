// Chức năng 1 + 5: danh sách hiển thị = tìm kiếm + lọc + sắp xếp kết hợp
window.DisplayFeature = {
  computed: {
    displayedProducts() {
      const list = this.products.filter(p => this.matchesKeyword(p) && this.matchesCategory(p));
      return this.sortProducts(list);
    }
  }
};

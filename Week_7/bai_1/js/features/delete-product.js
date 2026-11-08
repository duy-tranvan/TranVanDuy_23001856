// Chức năng 7: xóa sản phẩm sau khi xác nhận
window.DeleteProductFeature = {
  data() { return { pendingDelete: null }; },
  methods: {
    askDelete(p) { this.pendingDelete = p; },
    cancelDelete() { this.pendingDelete = null; },
    confirmDelete() {
      const id = this.pendingDelete.id;
      this.products = this.products.filter(p => p.id !== id);
      this.pendingDelete = null;
      // Danh mục đang lọc không còn sản phẩm -> quay về "Tất cả"
      if (this.category && !this.categories.includes(this.category)) this.category = '';
    }
  }
};

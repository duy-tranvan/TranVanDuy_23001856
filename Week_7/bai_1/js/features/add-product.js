// Chức năng 6: thêm sản phẩm + kiểm tra dữ liệu
window.AddProductFeature = {
  data() {
    return {
      nextId: window.SAMPLE_PRODUCTS.length + 1,
      form: { name: '', price: '', category: '', stock: '' },
      errors: { name: '', price: '', category: '', stock: '' }
    };
  },
  methods: {
    validate() {
      const e = { name: '', price: '', category: '', stock: '' };
      const price = Number(this.form.price);
      const stockText = String(this.form.stock).trim();
      const stock = Number(stockText);
      if (!this.form.name.trim()) e.name = 'Tên không được để trống.';
      if (String(this.form.price).trim() === '' || !(price > 0)) e.price = 'Giá phải lớn hơn 0.';
      if (!this.form.category.trim()) e.category = 'Hãy nhập danh mục.';
      if (stockText === '' || !Number.isInteger(stock) || stock < 0) e.stock = 'Tồn kho phải là số nguyên không âm.';
      this.errors = e;
      return !Object.values(e).some(Boolean);
    },
    addProduct() {
      if (!this.validate()) return;
      this.products.push({
        id: this.nextId++,
        name: this.form.name.trim(),
        price: Number(this.form.price),
        category: this.form.category.trim(),
        stock: Number(this.form.stock)
      });
      this.form = { name: '', price: '', category: '', stock: '' };
    }
  }
};

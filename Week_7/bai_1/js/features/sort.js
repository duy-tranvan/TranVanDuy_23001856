// Chức năng 4: sắp xếp theo giá trên BẢN SAO, không đổi mảng gốc
window.SortFeature = {
  data() { return { sortOrder: '' }; },
  methods: {
    sortProducts(list) {
      if (this.sortOrder === 'asc') return [...list].sort((a, b) => a.price - b.price);
      if (this.sortOrder === 'desc') return [...list].sort((a, b) => b.price - a.price);
      return list;
    }
  }
};

// Chức năng 2: tìm kiếm theo tên, không phân biệt hoa/thường
window.SearchFeature = {
  data() { return { keyword: '' }; },
  methods: {
    matchesKeyword(p) {
      const kw = this.keyword.trim().toLowerCase();
      return !kw || p.name.toLowerCase().includes(kw);
    }
  }
};

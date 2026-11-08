// Chức năng 9: watch từ khóa - báo khi đúng 1 ký tự, xóa khi rỗng hoặc >= 2 ký tự
window.KeywordWatchFeature = {
  data() { return { keywordNotice: '' }; },
  watch: {
    keyword(value) {
      this.keywordNotice = value.length === 1
        ? 'Từ khóa mới có 1 ký tự, hãy nhập thêm để kết quả chính xác hơn.'
        : '';
    }
  }
};

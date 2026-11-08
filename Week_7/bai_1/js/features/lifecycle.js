// Chức năng 10: mounted() đặt trạng thái "Sẵn sàng"
window.LifecycleFeature = {
  data() { return { pageStatus: 'Đang tải...' }; },
  mounted() { this.pageStatus = 'Sẵn sàng'; }
};

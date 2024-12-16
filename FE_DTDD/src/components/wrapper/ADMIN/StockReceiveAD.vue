<template>
    <div id="app">
      <h1>Quản Lý Nhập Kho</h1>
  
      <!-- Tabs -->
      <nav class="tabs">
        <button
          v-for="tab in tabs"
          :key="tab.name"
          :class="{ active: currentTab === tab.name }"
          @click="currentTab = tab.name"
        >
          {{ tab.label }}
        </button>
      </nav>
  
      <!-- Nội dung của từng Tab -->
      <div class="tab-content">
        <component :is="currentTabComponent"></component>
      </div>
    </div>
  </template>
  
  <script>
  import InventoryList from "./StockReceive/InventoryList.vue";
  import StockIn from "./StockReceive/StockIn.vue";
  import StockOut from "./StockReceive/StockOut.vue";
  import InventoryReport from "./StockReceive/InventoryReport.vue";
  
  export default {
    components: {
      InventoryList,
      StockIn,
      StockOut,
      InventoryReport,
    },
    data() {
      return {
        currentTab: "InventoryList", // Tab mặc định
        tabs: [
          { name: "InventoryList", label: "Danh sách tồn kho" },
          { name: "StockIn", label: "Nhập kho" },
          { name: "StockOut", label: "Xuất kho" },
          { name: "InventoryReport", label: "Báo cáo tổng quan" },
        ],
      };
    },
    computed: {
      currentTabComponent() {
        return this.currentTab; // Xác định component hiển thị
      },
    },
  };
  </script>
  
  <style scoped>
  h1 {
    text-align: center;
    margin-bottom: 20px;
  }
  .tabs {
    display: flex;
    justify-content: center;
    gap: 10px;
    margin-bottom: 20px;
  }
  button {
    padding: 10px 20px;
    border: none;
    background-color: #007bff;
    color: white;
    cursor: pointer;
    border-radius: 5px;
  }
  button.active {
    background-color: #0056b3;
  }
  button:hover {
    background-color: #0056b3;
  }
  .tab-content {
    padding: 20px;
    border: 1px solid #ddd;
    border-radius: 5px;
  }
  </style>
  
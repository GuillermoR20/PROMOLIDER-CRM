import api from './api';

const apiBank = {
  list: () => api.get('/config/bank/list'),
  add: (bank) => api.post('/config/bank/add', bank),
  detail: (id) => api.get(`/config/bank/detail/${id}`),
  edit: (bank) => api.put(`/config/bank/edit/${bank.id}`),
  delete: (id) => api.delete(`/config/bank/delete/${id}`),
};

export default apiBank;

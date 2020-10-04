import { API_BASE } from '../config';

export default {
  async create(id: number, language: string, translation: string) {
    await fetch(`${API_BASE}/key/${id}/translation`, {
      method: 'POST',
      body: JSON.stringify({ language, translation }),
      headers: {
        'content-type': 'application/json',
      },
      mode: 'cors',
    });
  },

  async edit(id: number, language: string, translation: string) {
    await fetch(`${API_BASE}/key/${id}/translation/${language}`, {
      method: 'PATCH',
      body: JSON.stringify({ translation }),
      headers: {
        'content-type': 'application/json',
      },
      mode: 'cors',
    });
  },

  async delete(id: number, language: string) {
    await fetch(`${API_BASE}/key/${id}/translation/${language}`, {
      method: 'DELETE',
      mode: 'cors',
    });
  },
};

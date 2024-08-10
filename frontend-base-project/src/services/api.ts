const API_BASE_URL =
  import.meta.env.VITE_API_BASE_URL || 'http://localhost:8000/api';

async function request<T>(url: string, options?: RequestInit): Promise<T> {
  const response = await fetch(`${API_BASE_URL}${url}`, {
    headers: {
      'Content-Type': 'application/json',
    },
    ...options,
  });

  if (!response.ok) {
    const error = await response.json();

    if (error.message) {
      throw new Error(`Error: ${error.message}`);
    }
    return Promise.reject(error);
  }

  return response.json();
}

export default {
  getGuests() {
    return request<Guest[]>('/guests');
  },
  createGuest(data: { name: string; room: string }) {
    return request('/guests', {
      method: 'POST',
      body: JSON.stringify(data),
    });
  },
  updateGuest(id: number, data: { name: string; room: string }) {
    return request(`/guests/${id}`, {
      method: 'PUT',
      body: JSON.stringify(data),
    });
  },
  getRooms() {
    return request<Room[]>('/rooms');
  },
  createRoom(data: { name: string; capacity: number }) {
    return request('/rooms', {
      method: 'POST',
      body: JSON.stringify(data),
    });
  },
  updateRoom(id: number, data: { name: string; capacity: number }) {
    return request(`/rooms/${id}`, {
      method: 'PUT',
      body: JSON.stringify(data),
    });
  },
  assignRoom(roomId: number, guestId: number) {
    return request(`/rooms/${roomId}/assign`, {
      method: 'POST',
      body: JSON.stringify({ guestId }),
    });
  },
  deassignRoom(roomId: number) {
    return request(`/rooms/${roomId}/deassign`, {
      method: 'POST',
    });
  },
  setRoomAsReady(roomId: number) {
    return request(`/rooms/${roomId}/set-as-ready`, {
      method: 'POST',
    });
  },
};

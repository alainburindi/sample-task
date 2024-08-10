<template>
    <div>
      <h2 class="text-3xl mb-4">Rooms</h2>
      <button
        @click="openRoomForm"
        class="bg-red-700 px-4 py-2 mb-6"
      >
        Add new room
      </button>
  
      <RoomForm ref="roomForm" @submit="addRoom"></RoomForm>
  
      <div class="flex space-x-4">
        <div
          v-for="room in rooms"
          :key="room.id"
          class="bg-gray-100 text-black p-4 rounded-md w-1/3"
        >
          <h3 class="text-xl mb-2">{{ room.name }}</h3>
          <p>Capacity: {{ room.capacity }}</p>
          <p>Status: {{ room.status }}</p>
          <button
            v-if="room.status === 'READY'"
            class="bg-red-700 mt-4 w-full py-2"
          >
            Assign Guest
          </button>
          <button
            v-else-if="room.status === 'MAINTENANCE'"
            class="bg-red-700 mt-4 w-full py-2"
          >
            Set as Ready
          </button>
          <button
            v-else
            class="bg-red-700 mt-4 w-full py-2"
          >
            Room Empty
          </button>
        </div>
      </div>
    </div>
  </template>
  
  <script lang="ts">
  import { defineComponent, ref } from 'vue';
  import RoomForm from './RoomForm.vue';
  
  interface Room {
    id: number;
    name: string;
    capacity: number;
    status: 'READY' | 'MAINTENANCE' | 'TAKEN';
  }
  
  export default defineComponent({
    components: {
      RoomForm,
    },
    setup() {
      const rooms = ref<Room[]>([
        { id: 1, name: 'Room #1', capacity: 2, status: 'READY' },
        { id: 2, name: 'Room #2', capacity: 1, status: 'MAINTENANCE' },
        { id: 3, name: 'Room #3', capacity: 1, status: 'TAKEN' },
      ]);
  
      const roomForm = ref<InstanceType<typeof RoomForm> | null>(null);
  
      const openRoomForm = () => {
        roomForm.value?.openDialog();
      };
  
      const addRoom = (newRoom: { name: string; capacity: number; status: 'READY' | 'MAINTENANCE' | 'TAKEN' }) => {
        const id = rooms.value.length + 1;
        rooms.value.push({ id, ...newRoom });
      };
  
      return {
        rooms,
        roomForm,
        openRoomForm,
        addRoom,
      };
    },
  });
  </script>
  
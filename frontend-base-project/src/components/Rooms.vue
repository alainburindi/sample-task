<template>
  <div class="mt-12">
    <h2 class="text-3xl mb-4">Rooms</h2>
    <button @click="openRoomForm" class="bg-red-700 px-4 py-2 mb-6">
      Add new Room
    </button>

    <RoomForm ref="roomForm" @submit="addRoom"></RoomForm>
    <!-- Display the error messages -->
    <div
      v-if="Object.entries(errors).length"
      class="p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg mb-2"
    >
      <div v-for="(messages, field) in errors" :key="field" class="mb-2">
        <h4 class="font-bold text-red-600">Errors for {{ field }}:</h4>
        <p
          v-for="(message, index) in messages"
          :key="index"
          class="text-red-700"
        >
          - {{ message }}
        </p>
      </div>
    </div>

    <div class="flex space-x-4">
      <div
        v-for="room in rooms"
        :key="room.id"
        class="bg-gray-100 text-black p-4 rounded-md w-1/3"
      >
        <h3 class="text-xl mb-2">{{ room.room_number }}</h3>
        <p>Capacity: {{ room.capacity }}</p>
        <p>Status: {{ room.status }}</p>
        <div class="flex space-x-2 mt-4">
          <button @click="assignGuest(room.id)" class="bg-red-700 w-full py-2">
            Assign Guest
          </button>
          <button @click="setAsReady(room.id)" class="bg-red-700 w-full py-2">
            Set as Ready
          </button>
          <!-- <button @click="deleteRoom(room.id)" class="bg-red-700 w-full py-2">Room Empty</button> -->
        </div>
      </div>
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent, ref, onMounted } from 'vue';
import api from '../services/api';
import RoomForm from './RoomForm.vue';

export default defineComponent({
  components: {
    RoomForm,
  },
  setup() {
    const errors = ref([]); // Holds error messages

    const rooms = ref<Room[]>([]);

    const roomForm = ref<InstanceType<typeof RoomForm> | null>(null);

    const openRoomForm = () => {
      roomForm.value?.openDialog();
    };

    const fetchRooms = async () => {
      try {
        const response = await api.getRooms();
        rooms.value = response;
      } catch (error) {
        console.error('Error fetching rooms:', error);
      }
    };

    const addRoom = async (newRoom: { name: string; capacity: number }) => {
      try {
        await api.createRoom(newRoom);
        fetchRooms();
      } catch (errorData) {
        errors.value = errorData;
        console.error('errors:', errorData);
      }
    };

    const assignGuest = async (roomId: number) => {
      // TODO: Implement the assignGuest method
    };

    const setAsReady = async (roomId: number) => {
      try {
        await api.setRoomAsReady(roomId);
        fetchRooms(); // Refresh the room list
      } catch (error) {
        console.error('Error setting room as ready:', error);
      }
    };

    onMounted(() => {
      fetchRooms();
    });

    return {
      rooms,
      roomForm,
      openRoomForm,
      addRoom,
      assignGuest,
      setAsReady,
      errors,
    };
  },
});
</script>

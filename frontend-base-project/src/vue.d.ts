declare module '*.vue' {
  import type { DefineComponent } from 'vue';
  const component: DefineComponent<object, object, any>;
  export default component;
}

interface Room {
  id: number;
  name: string;
  capacity: number;
  status: 'READY' | 'MAINTENANCE' | 'TAKEN';
}

interface Guest {
  id: number;
  name: string;
  room: string;
}

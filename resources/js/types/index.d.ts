export interface User {
  id:                number;
  name:              string;
  avatar:            null;
  email:             string;
  email_verified_at: Date;
  is_admin:          number;
  blocked_at:        null;
  created_at:        string;
  updated_at:        string;
  pivot:             Pivot;
}

export interface UserInfo extends User {
  blocked_at: null;
  last_message?: string;
  last_message_date?: string;
}



export type PageProps<T extends Record<string, unknown> = Record<string, unknown>> = T & {
  auth: {
    user: User;
  };
  conversations: Conversation[];
};

export interface Conversation {
  id:                number;
  name:              string;
  avatar?:           string;
  email?:            string;
  is_group:          boolean;
  is_user?:          boolean;
  is_admin?:         number;
  created_at:        string;
  updated_at:        string;
  blocked_at?:       null;
  last_message:      null | string;
  last_message_date: string | null;
  description?:      string;
  owner_id?:         number;
  users?:            User[];
  user_ids?:         number[];
}



export interface Pivot {
  group_id: number;
  user_id:  number;
}


export interface User {
  id: number;
  name: string;
  email: string;
  email_verified_at: string;
  avatar?: string;
  is_admin: boolean;
  // blocked_at: string;
  created_at: string;
  updated_at: string;
  last_message?: string;
  last_message_date?: string;
}

export type PageProps<T extends Record<string, unknown> = Record<string, unknown>> = T & {
  auth: {
    user: User;
  };
};

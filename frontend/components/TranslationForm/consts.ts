export type LanguageId = string;

export type Translation = {
  language: string;
  translation: string;
  rtl: boolean;
};

export interface Entry {
  id: number;
  name: string;
  translations: Record<LanguageId, Translation>;
}

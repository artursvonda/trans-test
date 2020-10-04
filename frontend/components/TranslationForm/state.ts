import { Language } from 'context/Languages';
import { LanguageId, Translation } from './consts';

type State = Partial<
  Record<
    LanguageId,
    { translation: Translation; isEditing: boolean; isNew: boolean }
  >
>;

export const add = (language: Language) => ({ type: 'add', language } as const);

export const cancel = (language: LanguageId) =>
  ({ type: 'cancel', language } as const);

export const update = (translation: string, language: string) =>
  ({ type: 'update', translation, language } as const);

export const create = (translation, language) =>
  ({ type: 'create', translation, language } as const);

export const edit = (language: string) => ({ type: 'edit', language } as const);

export const remove = (language: string) =>
  ({ type: 'delete', language } as const);

type Actions =
  | ReturnType<typeof add>
  | ReturnType<typeof cancel>
  | ReturnType<typeof update>
  | ReturnType<typeof create>
  | ReturnType<typeof edit>
  | ReturnType<typeof remove>;

export const reducer = (state: State, action: Actions) => {
  switch (action.type) {
    case 'add':
      return {
        ...state,
        [action.language.id]: {
          translation: {
            translation: '',
            language: action.language.id,
            rtl: action.language.rtl,
          },
          isNew: true,
          isEditing: true,
        },
      };
    case 'cancel':
      if (state[action.language]?.isNew) {
        const newState = { ...state };
        delete newState[action.language];

        return newState;
      } else {
        return {
          ...state,
          [action.language]: {
            ...state[action.language],
            isEditing: false,
          },
        };
      }
    case 'edit':
      return {
        ...state,
        [action.language]: {
          ...state[action.language],
          isEditing: true,
        },
      };
    case 'update':
      return {
        ...state,
        [action.language]: {
          ...state[action.language],
          translation: {
            ...state[action.language].translation,
            translation: action.translation,
          },
          isEditing: false,
        },
      };
    case 'create':
      return {
        ...state,
        [action.language]: {
          ...state[action.language],
          translation: {
            ...state[action.language].translation,
            translation: action.translation,
          },
          isNew: false,
          isEditing: false,
        },
      };
    case 'delete':
      const newState = { ...state };
      delete newState[action.language];

      return newState;
    default:
      return state;
  }
};
